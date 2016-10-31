var pages = document.getElementsByClassName('tab-page');

if (pages.length) {
  var buttons = document.querySelectorAll('.tab-header ul li a');

  function clickpage(a, b, c) {

    if (a['target'].attributes['data-page']) {
      for (var i = 0; i < pages.length; i++) {
        pages[i].style.display = 'none';
      }
      for (var i = 0; i < pages.length; i++) {
        buttons[i].className = '';
      }
      var id = a['target'].getAttribute('data-page').toString().substring(1);

      var page = document.getElementById(id);
      var btn = document.getElementById('btn_' + id);
      if (page != null) {
        page.style.display = 'block';
        btn.className = 'selected';
      }
    }
  }

  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', clickpage);
  }

  pages[0].style.display = 'block';
  buttons[0].className = 'selected';
}
