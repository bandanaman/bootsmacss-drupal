(function ($) {
  Drupal.behaviors.waatCounter = {
    attach: function (context, settings) {
      $('.counter__pie').once('counter-pie', function(){

        // Get field settings.
        var trackColor = Drupal.settings.waat_formatters.counterTrackColor,
            trackWidth = Drupal.settings.waat_formatters.counterTrackWidth,
            barColor = Drupal.settings.waat_formatters.counterBarColor,
            lineWidth = Drupal.settings.waat_formatters.counterLineWidth;
            counterId = Drupal.settings.waat_formatters.counterId;

            // Calculate how many items are on page.
            quantity = counterId.length;

        // Function that cal
        function calculateCounter() {
          // Erase counters if are already rendered (on window resize).
          var $counterCanvas = $('.counter__pie canvas');

          if ($counterCanvas.length) {
            $counterCanvas.remove();
          }

          // Implement script for each element on page.
          for (var i = 0; i < quantity; i++) {
            var id = '#counter-' + counterId[i],
                wrapper = document.querySelector(id),
                element = document.querySelector(id + ' .counter__pie');

            // If selected element exists (prevent js errors).
            if($(id).length) {
              var wrapperSize = wrapper.offsetWidth;

              // Change widget version from floating to full width if neccesary.
              if (wrapperSize <= 120) {
                $(id).addClass('is-big');
                $(id).find('.counter__left.counter__left--zero').addClass('hidden');
              }
              else {
                $(id).removeClass('is-big');
                $(id).find('.counter__left.counter__left--zero').removeClass('hidden');
              }

              var elementSize = element.offsetWidth;

              new EasyPieChart(element, {
                scaleColor: false,
                trackColor: trackColor[i],
                trackWidth: trackWidth[i],
                barColor: barColor[i],
                lineWidth: lineWidth[i],
                lineCap: 'butt',
                size: elementSize
              });
            }
          }
        }

        calculateCounter();

        $(window).resize(function() {
          calculateCounter();
        });
      });
    }
  };

}(jQuery));
