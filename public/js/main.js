
$("#toggle-message").click(() => {
    $("#message").toggle();
});

var quill = new Quill('#form-textarea', {
    modules: {
      toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['code-block']
      ]
    },
    placeholder: 'Compose an epic...',
    theme: 'snow'  // or 'bubble'
  });

  $(".ql-editor").on("keypress", function (e) {
    let hvalue = $('.ql-editor').html();
    $("#create-post-form-textarea").val(hvalue);
   });