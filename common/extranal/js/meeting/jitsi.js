"use strict";
//   $(document).ready(function () {
//         "use strict";
//         const domain = '8x8.vc';
//         document.getElementById('meeting');
//         const options = {
//             roomName: room_id,
//             height: 500,
//             parentNode: document.querySelector("#meeting"),
//             userInfo: {
//                 email: $('#email').val(),
//                 displayName: $('#username').val()
//             },
//             enableClosePage: true,
//             SHOW_PROMOTIONAL_CLOSE_PAGE: true,

//         };
//         const api = new JitsiMeetExternalAPI(domain, options);
//     });



document.addEventListener('DOMContentLoaded', (event) => {
    const domain = "meet.jit.si";
    const options = {
        roomName: room_id,
        // width: 700,
        height: 500,
        parentNode: document.querySelector('#meeting'),
        configOverwrite: {},
        interfaceConfigOverwrite: {
            // Overwrite the default interface configuration here
        },
        userInfo: {
            email: $('#email').val(),
            displayName: $('#username').val()
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);

    // Event Listeners
    api.addEventListener('videoConferenceJoined', () => {
        console.log('Video conference joined');
    });

    api.addEventListener('participantLeft', () => {
        console.log('Participant left');
    });

    // More event listeners can be added here
});