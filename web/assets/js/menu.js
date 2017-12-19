$( document ).ready(function() {
    console.log( "redi" );
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  	});
    $(".dropdown-button").dropdown();
    $('.modal').modal();
    $('.tooltipped').tooltip({delay: 50});
    
});