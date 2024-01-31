document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('ckeditor').style.display = 'none';
});
ClassicEditor
.create( document.querySelector( '#ckeditor' ), {
  toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'codeBlock' ],
  language: {
  ui: 'en',
  content: 'ar'
  }
} )
.then( editor => {
  window.editor = editor;
} )
.catch( err => {
  console.error( err.stack );
} );

