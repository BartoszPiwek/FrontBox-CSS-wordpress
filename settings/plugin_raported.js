/*
 * Author: Iestyn Polley
 * https://github.com/iestyn
 */

'use strict';

module.exports = function( results ) {
  var path = require( 'path' ),
    files = {},
    out = [],
    pairs = {
      '&': '&amp;',
      '"': '&quot;',
      '\'': '&apos;',
      '<': '&lt;',
      '>': '&gt;'
    };

  function encode( s ) {
    for ( var r in pairs ) {
      if ( typeof s !== 'undefined' ) {
        s = s.replace( new RegExp( r, 'g' ), pairs[ r ] );
      }
    }
    return s || '';
  }

  results.forEach(function( result ) {
    // Register the file
    result.file = path.normalize( result.file );
    if ( !files[ result.file ] ) {
      files[ result.file ] = [];
    }

    // Add the error
    files[ result.file ].push({
      severity: result.type,
      line: result.lastLine,
      column: result.lastColumn,
      message: result.message,
      source: 'htmllint.Validation' + ( result.type === 'error' ? 'Error' : 'Warning' )
    });

  });

  out.push( '<?xml version="1.0" encoding="utf-8"?>\n<body>\n<h2>Failed files : ' + Object.keys( files ).length + '</h2><h3>Errors: <span style="color:red">' + results.length + '</span></h1>\n</body>' );

  for ( var fileName in files ) {
    if ( files.hasOwnProperty( fileName ) ) {
      out.push( '<h4>file: ' + fileName + '<span style="color:red"> (' + files[ fileName ].length + ') </span></h4><ol>');
      for ( var i = 0, len = files[ fileName ].length; i < len; i++ ) {
        out.push("<li>");
        var issue = files[ fileName ][ i ];
        out.push(
          'line ' + issue.line + ', ' +
          'char ' + issue.column + ': ' +
          encode( issue.message )
       );
       out.push("</li>");
      }
      out.push("</ol>");
    }
  }

  out.push( '</testsuite>' );

  return out.join( '\n' );
};
