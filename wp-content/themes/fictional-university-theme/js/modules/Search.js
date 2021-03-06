import $ from 'jquery';

class Search {

    // 1. describe and create/initiate our object
  constructor(){

    // Add the overlay to the dom once the page is loaded
    this.addSearchHTML();

    this.resultsDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    
    // Make sure the event listeners gets added to the page right away
    this.events();

    // State variable to see of the search overlay is already open
    this.isOverlayOpen = false;

    // State variable to see of the spinner is already visible
    this.isSpinnerVisible = false;

    // Keep track of the previous serach value
    this.previousValue;
    this.typingTimer;
  }

    // 2. events
  events(){
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this))
  }

    // 3. methods (function, action...)

    typingLogic() {

      // Prevent search calls from happening if the keystroke doesn't 
      // actually change the input value
      if (this.searchField.val() != this.previousValue) {

        clearTimeout(this.typingTimer);

        if (this.searchField.val()) {

          if (!this.isSpinnerVisible) {
            this.resultsDiv.html('<div class="spinner-loader"></div>');
            this.isSpinnerVisible= true;
          }
          this.typingTimer = setTimeout(this.getResults.bind(this), 750);
          
        } else {
            this.resultsDiv.html('');
            this.isSpinnerVisible = false;
        }
      
      }
     
      this.previousValue = this.searchField.val();


    }

    getResults() {

      $.getJSON(universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val(), (results) => {

        this.resultsDiv.html(`
          <div class="row">

              <div class="one-third">
                 <h2 class="search-overlay__section-title">General Information</h2>

                 ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}

                 ${results.generalInfo.map(item  => `<li> <a href="${item.permlink}">${item.title}</a> 
                 
                 ${item.postType == 'post' ?  `by ${item.authorName}` :  ''}
                 
                 </li>`).join('')}
       
                 ${results.generalInfo.length ? '</ul>' : ''}

              </div>

              <div class="one-third">
                  <h2 class="search-overlay__section-title">Programs</h2>

                  ${results.programs.length ? '<ul class="program-cards-search">' : `<p>No programs match that search. <a href="${universityData.root_url}/programs">View all programs</a></p>`}

                 ${results.programs.map(item  => `
                 <li class="program-card-search__list-item"> 
                    <a class="program-card-search" href="${item.permlink}">
                    <img class="program-card-search__image" src="${item.image}">
                    <span class="program-card-search__name">${item.title}</span>
                    </a>

                 
                 </li>`).join('')}
       
                 ${results.programs.length ? '</ul>' : ''}



                  <h2 class="search-overlay__section-title">Professors</h2>

                  ${results.professors.length ? '<ul class="professor-cards">' : `<p>No professors match that search.`}

                  ${results.professors.map(item  => ` 
                  <li class="professor-card__list-item">
                    <a class="professor-card" href="${item.permalink}">
                      <img class="professor-card__image" src="${item.image}">
                      <span class="professor-card__name">${item.title}</span>
                    </a>
                  </li>
                  `).join('')}
        
                  ${results.professors.length ? '</ul>' : ''}


              </div>
              <div class="one-third">

                  <h2 class="search-overlay__section-title">Events</h2>

                  ${results.events.length ? '' : `<p>No events match that search. <a href="${universityData.root_url}/events">View all events</a></p>`}

                  ${results.events.map(item  => `

                <div class="event-summary">

                      <a class="event-summary__date t-center" href="${item.permalink}">
                        <span class="event-summary__month">${item.month}</span>
                        <span class="event-summary__day">${item.day}</span>  
                      </a>
                    
                      <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                        <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                      </div>
                
                </div>

                  `).join('')}

              
              </div>

              
          </div>

        `);

        this.isSpinnerVisible = false;

      });

    }

    keyPressDispatcher(e) {

      // Use (S)key as a keyboard shortcut to open the search overlay, 
      // as long as the overlay is not already open, ie (this.isOverlayOpen = false)
      // and as long as no other inputs, or textarea in the page has focus
      if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
        this.openOverlay();
      }

      // Use (ESC)key as a keyboard shortcut to close the search overlay
      // as long as the overlay is currently open, ie (this.isOverlayOpen = true)
      if (e.keyCode == 27 && this.isOverlayOpen) {
        this.closeOverlay();
      }
    }

    // Opens the overlay when the search icon is clicked
    openOverlay() {
      this.searchOverlay.addClass("search-overlay--active");
      $("body").addClass("body-no-scroll");
      this.searchField.val('');
      setTimeout(() => this.searchField.focus(), 301);
      this.isOverlayOpen = true;
      return false;
    }

    // Closes the overlay when the close icon is clicked
    closeOverlay() {
      this.searchOverlay.removeClass("search-overlay--active");
      $("body").removeClass("body-no-scroll");
      this.isOverlayOpen = false;
    }


    // Appends the search overlay to the html body
    addSearchHTML() {
      $("body").append(`
        <div class="search-overlay">
          <div class="search-overlay__top">
            <div class="container">
              <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
              <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
              <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
            </div>
          </div>
          
          <div class="container">
            <div id="search-overlay__results"></div>
          </div>
  
        </div>
      `);

    }
  
}

export default Search;
