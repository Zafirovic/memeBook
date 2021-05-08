function toggleLoggedInUserDropdown(event) {
    $('#loggedInDropdown').toggle('show');
}

$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});

$(document).on('click', '.dropdown-menu .dropdown-submenu', function (e) {
    e.stopPropagation();
});

// function toggleImageTextOptions(event) {
//     closeDropdowns();
//     let currentTarget = $(event.target);
//     let selectedOptions;
//     selectedOptions = currentTarget.is('i') ? currentTarget.parent('span.input-group-text').next('div.text-change-options')
//                                             : selectedOptions = currentTarget.next('div.text-change-options');
//     selectedOptions.toggle('show');
// }

//Prevent dropdown-menu close on events inside
// $(document).on('click', '.dropdown-menu', function (e) {
//     e.stopPropagation();
// });

// $('.dropdown-menu').on('click', function(e) {
//     e.stopPropagation();
// });

// $('.dropdown-item').on('click', function(e) {
//     e.preventDefault();
//     e.stopPropagation();
// });

function updateColor(event) {
    $(event).preventDefault();
}

// Close the dropdowns if the user clicks outside of it
// window.onclick = function(event) {
//     if (!$(event.target).hasClass('dropbtn')) {
//         closeDropdowns();
//     }
// }

// function closeDropdowns() {
//     var dropdowns = $('.dropdown-menu');
//         var i;
//         for (i = 0; i < dropdowns.length; i++) {
//             var openDropdown = dropdowns[i];
//             if ($(openDropdown).is(':visible')) {
//                 $(openDropdown).hide();
//             }
//         }
// }