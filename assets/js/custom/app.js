

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
});

$('#list_seasons li').click(function () {

    var data_season = JSON.parse(fixJSON(seasons.info));

    const dataInd = $(this).attr('data-ind');
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
                        <h3 class="card__title"><a style="color:${color}" href="#">${data.name}</a></h3>
                        <span class="card__category">
                            <a href="#">${seasons.term_lang} ${ind + 1}</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- end card -->
        `);
    });

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


    $('#player').attr('src', `/watch/series/${ep.id}/${ep.extension}`);
    $('#title_serie').text(ep.name);
    $('#img_serie').attr('src', ep.img);
    $('#name_ep_' + ep_num).css('color', '#4bc658');
    $('#watch_player').attr('hidden', false);
    $('#player')[0].play();
    scrollToPlayer();
    

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

                console.log(res);
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
        type: "DELETE",
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

    console.log(put)


    $.ajax({
        url: "/profile/add-watched",
        type: "POST",
        data: put,
        success: function (res) {

            info_player.already_watched = true;
            info_player.id_watched = JSON.parse(res).id;
            console.log(res);
        },
        error: function (err) {
            console.log(err.responseText);
        }
    });
}

async function setCheckpoint(checkpoint) {
    $.ajax({
        url: "/profile/checkpoint-watched",
        type: "PUT",
        data: {id: info_player.id_watched, checkpoint},
        success: function (res) {

        },
        error: function (err) {
            
        }
    });
}

$('#watch_player').ready(function () {

    var first_play = false;
    var lastCheckPoint = 0;
    var previousTime = 0;

    $('#player').on('loadeddata', () => {
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

        if (timeNow < lastCheckPoint) {
            lastCheckPoint = timeNow;

        } else if (timeNow - lastCheckPoint >= 10) {
            if (is_logged) await setCheckpoint(timeNow);
            lastCheckPoint = timeNow;
        }
    });

});


