import Axios from "axios";

$('.friend').click(function(e){
    e.preventDefault();
    // console.log(e);
    var friendid = e.target.parentNode.dataset['friendid'];
    var data = {
        friend_id: friendid
    }

        // console.log(friendid);
    Axios.post('/friends', data).then(response => {
        // console.log(e);
        // e.currentTarget.classList.remove('friend')
        e.target.className = "waves-light btn btn-block btn-danger remove"
        e.target.innerHTML = "Remove friend"
        document.location.reload()
    })
});


$('.remove').click(function (e){
    e.preventDefault();
    console.log("friend removed");
    var friendid = e.target.dataset['friendid'];
    // console.log(friendid);
    // console.log(e);

    var data = {
        friend_id: friendid
    }


    Axios.post('/friends/remove', data).then(response => {
        // console.log(e);

        e.target.innerHTML = "Send Friend Request"
        e.currentTarget.className = "waves-light btn btn-block btn-info friend"
        document.location.reload()
    })

});


$('.request').click(function(e){
    e.preventDefault();
    var request = e.target.previousElementSibling == null;
    var userid = e.target.parentNode.dataset['userid'];

    var data = {
        isRequest : request,
        user_id : userid
    }

    Axios.post('/request', data).then(response => {
        // console.log(e);
        if(response.data['true']){
            e.currentTarget.parentElement.innerHTML = "Friend Request accepted";
        }else{
            e.currentTarget.parentElement.innerHTML = "Friend reques Rejected";
        }

    })
});


