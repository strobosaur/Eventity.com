// ADMIN APPROVE EVENT BUTTON
$("#auth-events-btn").click(function(e){
    e.preventDefault;
    updateEventListAdmin(1);
})

// ADMIN APPROVE EVENT BUTTON
$("#all-events-btn").click(function(e){
    e.preventDefault;
    updateEventListAdmin(0);
})

// ADMIN APPROVE EVENT BUTTON
$("#user-list-btn").click(function(e){
    e.preventDefault;
    getUserListAdmin();
})

// ADMIN APPROVE EVENT BUTTON
$("#update-news-btn").click(function(e){
    e.preventDefault;
    getNewsUpdateAdmin();
})