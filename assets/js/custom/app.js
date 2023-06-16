


function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function setLanguage(val) {
    setCookie('language', val, 7);
    location.reload();
}

function fixJSON(jsonString) {
    const regex = /[\u0000-\u001F\u007F-\u009F]/g;
    return jsonString.replace(regex, '');
}


function scrollToPlayer() {
    var element = $("#player");
    $("html, body").animate({
        scrollTop: element.offset().top
    }, 1000);
}


function urlencode(str) {
    str = (str + '').toString();

    return encodeURIComponent(str)
        .replace('!', '%21')
        .replace('\'', '%27')
        .replace('(', '%28')
        .replace(')', '%29')
        .replace('*', '%2A');
}




$('#watch_movie').on('click', function () {
    var url = $('#watch_movie').attr('data-url');
    $('#player').attr('src', `/watch/${info_player.type}/${info_player.id}/${info_player.extension}`);
    $('#watch_player').attr('hidden', false);
    $('#player')[0].play();
    scrollToPlayer();
});

function toggleSeason(dataInd) {

    var data_season = JSON.parse(fixJSON(seasons.info));
    
    $('#show_ep').html('');
    data_season[dataInd].forEach((data, ind) => {
        
        const color = searchAlreadyWatched(data.id) ? '#4bc658' : '#fff';

        $('#show_ep').append(`
            <!-- card -->
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <div class="card">
                    <div class="card__cover">
                        <img src="${data.img}" alt="">
                        <a onclick="watchSerie(${dataInd}, ${ind})" href="#" class="card__play">
                            <i class="icon ion-ios-play"></i>
                        </a>
                    </div>
                    <div class="card__content">
                        <h3 class="card__title"><a style="color:${color}" id="name_ep_${ind}" href="#">${data.name}</a></h3>
                        <span class="card__category">
                            <a href="#">${seasons.term_lang} ${ind + 1}</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end card -->
        `);
    });


}

$('#list_seasons li').click(function () {

    const dataInd = $(this).attr('data-ind');
    toggleSeason(dataInd);

});


function searchAlreadyWatched(id) {

    if (list_watched == '') return false;

    const js = JSON.parse(list_watched);
    var info = false;
    
    for (const row of js) {
       if (id == row.ep) {
        info = row;
        break;
       }
    }

    return info;

}

var ep_now = {};
var is_next_ep = false;

function watchSerie(temp, ep_num) {

    var data_season = JSON.parse(fixJSON(seasons.info));
    var ep = data_season[temp][ep_num];

    info_watch = searchAlreadyWatched(ep.id);

    if (info_watch) {

        info_player.id_watched = info_watch.id,
        info_player.already_watched = true;
        info_player.current_time = info_watch.checkpoint;

    } else {

        info_player.id_ep = ep.id;
        info_player.already_watched = false;
        info_player.current_time = 0;
    }

    if (is_next_ep) info_player.current_time = 0;

    ep_now.temp = temp;
    ep_now.ep = ep_num;


    $('#player').attr('src', `/watch/series/${ep.id}/${ep.extension}`);
    $('#title_serie').text(ep.name);
    $('#plot').html(ep.plot);
    $('#img_serie').attr('src', ep.img);
    $('#name_ep_' + ep_num).css('color', '#4bc658');
    $('#watch_player').attr('hidden', false);
    $('#player')[0].play();

    scrollToPlayer();
    lock_next_ep = true;
    is_next_ep = false;
    

}

function Search(term) {
    if (term.length > 2) {
        window.location.href = '/search/' + urlencode(term);
    }
}


$('#list_type li').click(function () {
    const url = $(this).attr('data-url');
    window.location.href = url;
});

$('#list_category li').click(function () {
    const url = $(this).attr('data-url');
    window.location.href = url;
});

$('#search').keypress(function (event) {
    if (event.which === 13) {
        Search($('#search').val());
    }
});

$('#search_').keypress(function (event) {
    if (event.which === 13) {
        Search($('#search_').val());
    }
});


// ADD & Remove list BTN



function toggleToAdd(id) {
    $('#' + id).html(`<i class="icon ion-ios-add-circle"></i>${lang.add_list}`);
}

function toggleToRemove(id) {
    $('#' + id).html(`<i class="icon ion-ios-close-circle icon"></i>${lang.remove_list}`);
}

$('#add_list').on('click', function () {

    const id = $('#add_list').attr('data-id');
    const type = $('#add_list').attr('data-type');

    if (!is_added) {

        $.ajax({
            url: "/profile/add-list",
            type: "POST",
            data: { id, type },
            success: function (res) {

                toggleToRemove('add_list');
                is_added = true;

            },
            error: function (err) {
                toggleToAdd('add_list');
            }
        });

    } else {
        removeList(id, type);
    }

});


function removeList(id, type) {


    const id_tag = is_added ? 'add_list' : 'remove_list';

    $.ajax({
        url: "/profile/remove-list",
        type: "POST",
        data: { id, type },
        success: function (res) {

            toggleToAdd(id_tag);
            is_added = false;

        },
        error: function (err) {
            toggleToRemove(id_tag);
        }
    });


}


$('#remove_list').on('click', function () {
    const id = $('#remove_list').attr('data-id');
    const type = $('#remove_list').attr('data-type');
    removeList(id, type);
});


async function addWatched() {

    var put = { id: info_player.id, type: info_player.type };
    if (is_serie) put.id_ep = info_player.id_ep;


    $.ajax({
        url: "/profile/add-watched",
        type: "POST",
        data: put,
        success: function (res) {

            info_player.already_watched = true;
            info_player.id_watched = JSON.parse(res).id;
        },
        error: function (err) {
        }
    });
}

async function setCheckpoint(checkpoint) {
    $.ajax({
        url: "/profile/checkpoint-watched",
        type: "POST",
        data: {id: info_player.id_watched, checkpoint},
        success: function (res) {

        },
        error: function (err) {
            
        }
    });
}

function nextEpisode() {
    is_next_ep = true;

    var data_season = JSON.parse(fixJSON(seasons.info));
    
    const qtd_temps = data_season.length - 1;
    const qtd_eps = data_season[ep_now.temp].length - 1;

    var ep = ep_now.ep;
    var temp = ep_now.temp;

    if (ep == qtd_eps && temp == qtd_temps) {
        return;
    }

    if (ep < qtd_eps) {
        watchSerie(temp, ep + 1);

    } else if (ep >= qtd_eps) {
        toggleSeason(temp + 1);
        watchSerie(temp + 1, 0);
    }

    
    
}

var lock_next_ep = true;

$('#watch_player').ready(function () {

    var first_play = false;
    var lastCheckPoint = 0;
    var duration = 0;

    $('#player').on('loadeddata', () => {

       duration = $('#player')[0].duration;

       if (info_player.already_watched) {
            $('#player')[0].currentTime = info_player.current_time;
       }
    });

    $('#player').on('play', async function () {

        if (!info_player.already_watched) {
            if (is_logged) await addWatched();
            first_play = true;
        }
    });

    

    $('#player').on('timeupdate', async function () {
        
        var timeNow = this.currentTime;
        var percentage = (timeNow / duration) * 100;

        if (percentage > 1 && percentage < 98.8 && lock_next_ep) {
            lock_next_ep = false;
        }
        
        if (percentage > 98.9 && !lock_next_ep && is_serie) {
            lock_next_ep = true;
            nextEpisode();
        }

        if (timeNow < lastCheckPoint) {
            lastCheckPoint = timeNow;

        } else if (timeNow - lastCheckPoint >= 10) {
            if (is_logged) await setCheckpoint(timeNow);
            lastCheckPoint = timeNow;
        }
    });

});


