import Echo from "laravel-echo";

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '5f1a6be579f896578666',
    cluster: 'ap1',
    encrypted: true
});


