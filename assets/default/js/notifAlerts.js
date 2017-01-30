function registeredAlready(){
    notif({
        type: "error",
        msg: "You have already registered via our form, please login NOT using facebook!",
        position: "centre",
        fade: true
    });
}

function loginSuccess(){
    notif({
        type: "success",
        msg: "Login Successful!",
        position: "centre",
        fade: true
    });
}

function logoutSuccess(){
    notif({
        type: "success",
        msg: "Logout Successful!",
        position: "centre",
        fade: true
    });
}

function loginToLike(){
    notif({
        type: "error",
        msg: "You need to login or register to like this video",
        position: "centre",
        fade: true
    });
}

$('#login-to-like-error').notify({
    type: "error",
    msg: "You need to login or register to like this video",
    position: "centre",
    fade: true
});

function likeSuccess(){
    notif({
        type: "success",
        msg: "Video Liked and added to your like list!",
        position: "right",
        fade: true
    });
}

function unlikeSuccess(){
    notif({
        type: "warning",
        msg: "Video unliked and removed from your like list!",
        position: "right",
        fade: true
    });
}

function registerWithProviderSuccess(){
    notif({
        type: "success",
        msg: "You",
        position: "right",
        fade: true
    });
}
