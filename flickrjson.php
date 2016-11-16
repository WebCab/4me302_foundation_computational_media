<html>
  <head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <title>Search Imeages the You like </title>
    <style type="text/css">
    #flickr
    {
        display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 20px;
word-break: break-all;
word-wrap: break-word;
white-space: pre;
white-space: pre-wrap;
background-color: #f5f5f5;
border: 1px solid #ccc;
border: 1px solid rgba(0, 0, 0, 0.15);
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
    }
    </style>
  </head>
  <body>
    Search for <b>Vaxjo</b>, or anything else that you Like :-)
    <br />
    <br />    
    <input id="searchterm" />
    <button id="search">search</button>
    <div id="flickr"></div>
    <script>
      $("#search").click(function(){
        $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?",
        {
          tags: $("#searchterm").val(),
          tagmode: "any",
          format: "json"
        },
        function(data) {
          $.each(data.items, function(i,item){
            $("<img/>").attr("src", item.media.m).prependTo("#flickr");
            if ( i == 10 ) return false;
          });
        });
      });
    </script>
  </body>
</html>