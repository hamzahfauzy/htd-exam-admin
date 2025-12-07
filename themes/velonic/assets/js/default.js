document.addEventListener("DOMContentLoaded", function(){
    document.querySelector('.toggle-sidebar').addEventListener('click', e => {
      document.querySelector('.sidebar-default').classList.toggle('minimize')
      document.querySelector('.content-wrapper').classList.toggle('minimize')
    })

    document.querySelectorAll('.sidebar-default .nav-link').forEach(function(element){

      if(element.parentElement.classList.contains('has-submenu'))
      {
        element.addEventListener('click', function (e) {
    
          let nextEl = element.nextElementSibling;
          let parentEl  = element.parentElement;	
  
          element.classList.toggle('active')
    
            if(nextEl) {
                e.preventDefault();	
                let mycollapse = new bootstrap.Collapse(nextEl);
                
                if(nextEl.classList.contains('show')){
                  mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if(opened_submenu){
                      new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); // addEventListener
      }
      
    }) // forEach
  }); 