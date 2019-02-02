function googleSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var id_token = googleUser.getAuthResponse().id_token;

    var data = {
        id: profile.getId(),
        name: profile.getGivenName(),
        lastname: profile.getFamilyName(),
        avatar_url: profile.getImageUrl(),
        email: profile.getEmail(),
        token: id_token
    };

    var googleAuthRoute = $('[data-google-auth-route]').data('google-auth-route');

    $.ajax({
        url: googleAuthRoute,
        method: 'post',
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    }).done(function(response) {
        if (response.status === 'success') {
            window.location.href = response.route;
        } else {
            googleSignOut(response.route, response.msg);
        }
    }).fail(function(response) {
        showNotifier('danger', 'Could not process your request at this time. Try again later');
    });
}


