document.addEventListener('DOMContentLoaded', () => {
    var hamburger_menu = document.getElementsByClassName('hamburger-menu')[0];
    var sidebar_menu = document.getElementsByClassName('sidebar-menu')[0];
    var nav_admin = document.getElementsByClassName('nav-admin')[0];
    hamburger_menu ? hamburger_menu.addEventListener('click', () => {
        sidebar_menu.classList.toggle('active');
        nav_admin.classList.toggle('active');
        document.querySelector('body').classList.toggle('active');
    }) : null;

    // var btn_delete = document.getElementsByClassName('btn-delete');
    // for (const d of btn_delete) {
    //     d ? d.addEventListener('click', () => {
    //         Swal.fire({
    //             title: 'Apakah kamu yakin?',
    //             html: "<p class='msg'>Ingin menghapus data siswa ini!</p>",
    //             icon: 'question',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Yes, delete it!'
    //           }).then((result) => {
    //             if (result.isConfirmed) {
    //               Swal.fire({
    //                 title: 'Deleted!',
    //                 html: "<p class='msg'>Berhasil terhapus!</p>",
    //                 icon:'success',
    //                 showCancelButton: false,
    //                 showConfirmButton: false,
    //                 timer: 2000
    //               })
    //             }
    //           })
    //     }) : null
    // }

  // var btn_delete_candidate = document.getElementsByClassName('btn-delete-candidate');
  // for (const c of btn_delete_candidate) {
  //   c ? c.addEventListener('click', () => {
  //     Swal.fire({
  //       title: 'Apakah kamu yakin?',
  //       html: "<p class='msg'>Ingin menghapus data kandidat ini!</p>",
  //       icon: 'question',
  //       showCancelButton: true,
  //       confirmButtonColor: '#3085d6',
  //       cancelButtonColor: '#d33',
  //       confirmButtonText: 'Yes, delete it!'
  //     }).then((result) => {
  //       if (result.isConfirmed) {
  //         Swal.fire(
  //           'Deleted!',
  //           'Your file has been deleted.',
  //           'success'
  //         )
  //       }
  //     })
  //   }) : null
  // }
})