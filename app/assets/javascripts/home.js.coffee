# Place all the behaviors and hooks related to the matching controller here.
# All this logic will automatically be available in application.js.
# You can use CoffeeScript in this file: http://jashkenas.github.com/coffee-script/
$ ->
  setTimeout(  ->
    $('#fade-in').animate({
      opacity: 1
    },700)
  ,100)

  $('button#mig').click( (e) ->
    $('#fade-in').animate({
      opacity: 0
    },700, ->
      window.location.href = "game";
    )
  )

  $('img#logo').click( ->
    if(window.location.href != "")
      $('#fade-in').animate({
        opacity: 0
      }, 700,  ->
        window.location.href = "/";
      );
  )