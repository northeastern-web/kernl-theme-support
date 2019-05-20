(function() {

  // List of file includes
  var podsIncludes;

  // Catch the wp ajax request
  jQuery.post(
    ajaxurl,
    {
      'action': 'includes_request',
      'data':   'includes_request_id'
    },
    function(response) {
      podsIncludes = response;
    }
  );

  // Create tinyMCE button with file includes
  tinymce.PluginManager.add('add_script', function( editor, url ) {
    editor.addButton('includes_button', {
      text: '>Include file',
      icon: false,
      tooltip: 'Module List',
      onclick: function() {
        editor.windowManager.open({
          title: 'Available Includes',
          width: 400,
          height: 100,
          body: [
            {
              type: 'listbox',
              name: 'listboxName',
              label: 'Includes',
              values: podsIncludes
            }
          ],
          onsubmit: function(e) {
            editor.insertContent('[include file="' + e.data.listboxName + '"]');
          }
        });
      }
    });
  });

})();

