document.addEventListener('DOMContentLoaded', () => {
  var hamburger = document.querySelector('.hamburger');
  var mobileNavbar = document.querySelector('.mobile-navbar');
  var nav = document.querySelector('nav');
  var body = document.querySelector('body');
  hamburger ? hamburger.addEventListener('click', () => {
    mobileNavbar.classList.toggle('active')
    nav.classList.toggle('active')
    body.classList.toggle('active')
    profile.classList.toggle('pointer-events')
  }) : null

  var cardWrapper = [...document.querySelectorAll('.card-wrapper')];
  var prevBtn = [...document.querySelectorAll('.prev-btn')];
  var nextBtn = [...document.querySelectorAll('.next-btn')];
  cardWrapper ? cardWrapper.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nextBtn ? nextBtn[i].addEventListener('click', () => {
      item.scrollLeft += containerWidth;
    }): null

    prevBtn ? prevBtn[i].addEventListener('click', () => {
      item.scrollLeft -= containerWidth
    }): null
  }): null

  var pagesScroll = document.querySelectorAll('.page-scroll');
  pagesScroll ? pagesScroll.forEach(scroll => {
    scroll.addEventListener('click', (e) => {
      var hrefElement = scroll.getAttribute('href');
      var destinationElements = document.querySelector(hrefElement);
  
      var offset = destinationElements.offsetTop - 50;
      document.querySelector('html, body').scrollTop = offset;
      e.preventDefault();
    });
  }): null;

  var coreVissionText = document.querySelector('.core-vision-text');
  var coreVissionDescription = document.querySelector('.core-vision-description')
  var coreMissionText = document.querySelector('.core-mission-text')
  var coreMissionDescription = document.querySelector('.core-mission-description')
  var mainMore = document.querySelector('.main-more');

  var visionText = document.getElementsByClassName('vision-text');
  var visionDescription = document.getElementsByClassName('vision-description')
  var missionText = document.getElementsByClassName('mission-text')
  var missionDescription = document.getElementsByClassName('mission-description')
  var mainMoreCard = document.getElementsByClassName('main-more-card');
  var cards = document.querySelectorAll('.card');
  cards ? cards.forEach((card, i) => {
    card.addEventListener('click', () => {
      coreVissionText.innerHTML = visionText[i].innerHTML
      coreVissionDescription.innerHTML = visionDescription[i].innerHTML
      coreMissionText.innerHTML = missionText[i].innerHTML
      coreMissionDescription.innerHTML = missionDescription[i].innerHTML
      mainMore.href = mainMoreCard[i].href;
    })
  }): null

  var more = document.querySelector('.more')
  more ? more.addEventListener('click', () => {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      html: '<p class="paragraf-text">You must login first!</p>',
      confirmButtonColor: '#FAE455',
      confirmButtonText: 'Ok',
      footer: '<a class="footer-text" href="signin.html">Sign in</a>'
    })
  }): null

  var show = document.querySelectorAll('.show')
  var inputType = document.querySelectorAll('.input-type')
  show ? show.forEach((s, i) => {
    s.addEventListener('click', () => {
      s.classList.toggle('active')
      inputType[i].type === 'password' ? inputType[i].type = 'text' : inputType[i].type = 'password'
    })
  }): null

  var menu = document.querySelector('.menu');
  var profile = document.querySelector('.profile');
  profile ? profile.addEventListener('mousemove', () => {
    profile.classList.add('active');
  }): null

  profile ? profile.addEventListener('mouseleave', () => {
    profile.classList.remove('active');
  }): null

  menu ? menu.addEventListener('mousemove', () => {
    profile.classList.add('active');
  }): null
  
  menu ? menu.addEventListener('mouseleave', () => {
    profile.classList.remove('active');
  }): null
  
  var menuList = document.querySelectorAll('.menu-list')
  profile ? window.addEventListener('click', (e) => {
    if(e.target !== profile && e.target !== menu && e.target !== menuList[0] && e.target!== menuList[1] ) {
      profile.classList.remove('active');
    }
  }): null

  // var btnChoose = document.querySelector('.btn-choose');
  // btnChoose ? btnChoose.addEventListener('click', () => {
  //   Swal.fire({
  //     title: 'Are you sure?',
  //     html: "<p class='caption'>Want to vote for this candidate<p>",
  //     icon: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#FAE455',
  //     cancelButtonColor: '#F44E3F',
  //     confirmButtonText: 'Yes'
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       Swal.fire({
  //         title: 'Success!',
  //         html: '<p class="caption">You have selected this candidate.</p>',
  //         icon: 'success',
  //         confirmButtonColor: '#FAE455',
  //         confirmButtonText: 'Ok'
  //       })
  //     }
  //   })
  // }): null
  
})