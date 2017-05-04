<!DOCTYPE html>
<?php
$phpArray = array(
  array('td00', 'td01', 'td02', 'td03'),
  array('td10', 'td11', 'td12', 'td13'),
);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$( function () {

var tbarray = <?php echo json_encode( $phpArray ) ;?>;
// or use js array directly
/*
var tbarray = [
	['td00', 'td01', 'td02', 'td03'],
	['td10', 'td11', 'td12', 'td13']
];
*/
var tharray = ['th0', 'th1', 'th2', 'th3'];
var table = array2table( {
      tbodyArray: tbarray
    , theadArray: tharray // default: (none)
    , thTag:      'th'      // default: 'td'
    , setID:      'id'      // default: (none)
    , setClass:   'class'   // default: (none)
} );
	
$( 'body' ).append( table );
	
// or with custom column
/*
$( 'body' ).append( table )
  .find( '#id tbody td:nth-child( 1 )' ) // get column '1'
    .addClass( 'class1 class2' ) // add class
	.before('<td>repetitive</td>') // insert repetitive content column before
      //.end().find( '#id' ) // to select the table for other chained operation
        //.sortable()
;
*/
	
function array2table( data ) {
	var thTag =  ( data.thTag == null ) ? 'td' : 'th';
	var setID = ( data.setID == null ) ? '' : ' id="'+ data.setID +'"';
	var setClass = ( data.setClass == null ) ? '' : ' class="'+ data.setClass +'"';
	// 'thead'
	if ( data.theadArray == null ) {
		var thead = '';
	} else {
		var td = '';
		data.theadArray.forEach( function ( cell ) {
			td += '<'+ thTag +'>'+ cell +'</'+ thTag +'>';
		});
		var thead = '<thead>\n<tr>'+ td +'</tr></thead>\n';
	}
	// 'tbody'
	var tr = '';
	data.tbodyArray.forEach( function ( row, i ) {
		var td = '';
		row.forEach( function ( cell ) {
			td += '<td>'+ cell +'</td>';
		});
		tr += '<tr>'+ td +'</tr>\n';
		row.unshift( i ); // add row index to original array for sorting
	});
	return '<table'+ setID + setClass +'>\n'
			+ thead
			+ '<tbody>\n'+ tr +'</tbody>\n'
		+ '</table>';
}

} );
</script>
