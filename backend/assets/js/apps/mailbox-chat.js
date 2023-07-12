$('.search > input').on('keyup', function() {
    var rex = new RegExp($(this).val(), 'i');
    $('.people .person').hide();
    $('.people .person').filter(function() {
        return rex.test($(this).text());
    }).show();
});

const addClickOnPersonConversation = function() {
    if ($(this).hasClass('.active')) {
        return false;
    } else {
        var findChat = $(this).attr('data-chat');
        var personName = $(this).find('.user-name').text();
        var personImage = $(this).find('img').attr('src');
        var imageTitle = $(this).find('img').attr('title');

        $('#receiver').val($(this).attr('data-id'));
        var hideTheNonSelectedContent = $(this).parents('.chat-system').find('.chat-box .chat-not-selected').hide();
        var showChatInnerContent = $(this).parents('.chat-system').find('.chat-box .chat-box-inner').show();

        if (window.innerWidth <= 767) {
            $('.chat-box .current-chat-user-name .name').html(personName.split(' ')[0]);
        } else if (window.innerWidth > 767) {
            $('.chat-box .current-chat-user-name .name').html(personName);
        }
        $('.chat-box .current-chat-user-name img').attr('src', personImage);
        $('.chat-box .current-chat-user-name img').attr('title', imageTitle);
        $('.chat').removeClass('active-chat');
        $('.user-list-box .person').removeClass('active');
        $('.chat-box .chat-box-inner').css('height', '100%');
        $('.chat-box .overlay-phone-call').css('display', 'block');
        $('.chat-box .overlay-video-call').css('display', 'block');
        $(this).addClass('active');
        $('.chat[data-chat = ' + findChat + ']').addClass('active-chat');
    }
    if ($(this).parents('.user-list-box').hasClass('user-list-box-show')) {
        $(this).parents('.user-list-box').removeClass('user-list-box-show');
    }
    $('.chat-meta-user').addClass('chat-active');
    $('.chat-box').css('height', 'calc(100vh - 232px)');
    $('.chat-footer').addClass('chat-active');

    const ps = new PerfectScrollbar('.chat-conversation-box', {
        suppressScrollX: true
    });

    // ps.scrollTop = 0;
    const getScrollContainer = document.querySelector('.chat-conversation-box');
    getScrollContainer.scrollTop = getScrollContainer.scrollHeight;
}

const ps = new PerfectScrollbar('.people', {
    suppressScrollX: true
});

const updateConversation = function() {
    $.ajax({
        type: "POST",
        url: $("#chat-input-form").attr('data-update'),
        data: { receiver: $('#receiver').val() },
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.status == "success") {
                if (data.allusers) {
                    var new_people = "";
                    var new_chat = "";
                    $(".people").html("");
                    var receiver = $('#receiver').val();

                    $.each(data.allusers, function(index, user) {
                        if (user.different) {
                            new_people += '<div class="person" data-chat="person' + user.id + '" data-id="' + user.id + '">';
                            new_people += '<div class="user-info">';
                            new_people += '<div class="f-head">';
                            new_people += '<img title="' + user.user_type + '" src="' + user.profile + '" alt="avatar">';
                            new_people += '</div>';
                            new_people += '<div class="f-body">';
                            new_people += '<div class="meta-info">';
                            new_people += '<span class="user-name" data-name="' + user.fullname + '"> ' + user.fullname + '</span>';
                            new_people += '<span class="user-meta-time">' + user.lasttime + '</span>';
                            new_people += '</div>';
                            new_people += '<span class="preview">' + user.lastmessage + '</span>';
                            new_people += '</div>';
                            new_people += '</div>';
                            new_people += '</div>';

                            if (data.conversations) {
                                if (user.id == receiver) {
                                    var previous = '';
                                    var current_chat = $('.chat[data-chat = person' + user.id + ']');

                                    $.each(data.conversations, function(index, conv) {
                                        if ((conv.receiver == data.current && conv.sender == receiver) || (conv.receiver == receiver && conv.sender == data.current)) {
                                            if (previous != conv.date) {
                                                previous = conv.date;
                                                new_chat += '<div class="conversation-start">'
                                                new_chat += '<span >' + conv.date + '</span>';
                                                new_chat += '</div>';
                                            }
                                            new_chat += '<div class="bubble ' + ((data.current == conv.sender) ? 'me' : 'you') + '">';
                                            new_chat += conv.message;
                                            new_chat += '<span style="text-size: 34xp" class="messagetime"> ' + conv.time + ' </span>';
                                            new_chat += '</div>';
                                        }
                                    });
                                    current_chat.html(new_chat);
                                }
                            }
                        }
                    });

                    $(".people").html(new_people);
                    $('.user-list-box .person').on('click', addClickOnPersonConversation);
                }
            }
        }
    });
};


$.each($('.person'), function() {
    $(this).on('click', addClickOnPersonConversation);
});

$('.mail-write-box').on('keydown', function(event) {

    if (event.key === 'Enter') {
        var chatInput = $(this);
        var chatMessageValue = chatInput.val();
        if (chatMessageValue === '') { return; }
        $('#message').val(chatMessageValue);
        $messageHtml = '<div class="bubble me">' + chatMessageValue + '</div>';
        var appendMessage = $(this).parents('.chat-system').find('.active-chat').append($messageHtml);
        const getScrollContainer = document.querySelector('.chat-conversation-box');
        getScrollContainer.scrollTop = getScrollContainer.scrollHeight;
        var clearChatInput = chatInput.val('');
        $.ajax({
            type: "POST",
            url: $("#chat-input-form").attr('data-add'),
            data: new FormData(document.getElementById('chat-input-form')),
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(data) {}
        });
    }
})

$('.hamburger, .chat-system .chat-box .chat-not-selected p').on('click', function(event) {
    $(this).parents('.chat-system').find('.user-list-box').toggleClass('user-list-box-show');
});

setInterval(updateConversation, 5000);