window.Echo.channel('broadcastPublication-channel')
.listen('.broadcastPublication-event', (e) => {
    console.log(e);
});

