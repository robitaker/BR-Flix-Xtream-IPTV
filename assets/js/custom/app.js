

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
    $('#player').attr('src', url);
    $('#watch_player').attr('hidden', false);
});

$('#list_seasons li').click(function () {

    var data_season = JSON.parse(fixJSON(seasons.info));

    const dataInd = $(this).attr('data-ind');
    $('#show_ep').html('');

    data_season[dataInd].forEach((data, ind) => {
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
                        <h3 class="card__title"><a href="details.html">${data.name}</a></h3>
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

function watchSerie(temp, ep_num) {

    var data_season = JSON.parse(fixJSON(seasons.info));
    var ep = data_season[temp][ep_num];

    $('#player').attr('src', `/watch/series/${ep.id}/${ep.extension}`);
    $('#title_serie').text(ep.name);
    $('#img_serie').attr('src', ep.img);
    $('#name_ep_' + ep_num).css('color', '#4bc658');
    $('#watch_player').attr('hidden', false);
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