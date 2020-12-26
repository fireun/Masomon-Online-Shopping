 // upload image function
 $(document).ready(function(){
    $('#my-img').click(function(){
        $('#img-upload').click();
    });

});

// function openEdit(){
//     var viewMode = document.getElementsByClassName("profile-view-mode");
//     var editMode = document.getElementsByClassName("profile-edit-mode");

    
//     for(var i=0; i<=viewMode.length; i++){
//         viewMode[i].style.display = 'block';
//     }

//     for(var a=0; a<=editMode.length; a++){
//         editMode[a].style.display = 'none';
//     }
// }

// $('#openEdit').click(function(){
//     $('.profile-view-mode').css('display','block');
//     $('.profile-edit-mode').css('display','none');
// });


// const input = document.querySelector('.img-upload');
// const preview = document.querySelector('.my-img');

// input.addEventListener('change', updateImageDisplay);

//     function updateImageDisplay() {
//         const curFiles = input.files;
//         if(curFiles.length === 0) {

//             textContent = 'No files currently selected for upload';

//             console.log(textContent);
//         } else {
//             // const list = document.createElement('ol');
//             // preview.appendChild(list);
//             console.log('yes');
//         }
//     }


