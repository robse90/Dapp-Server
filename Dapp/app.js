
const formOne = document.querySelector('#myForm')
const formTwo = document.querySelector('#myForm2')
const formThree = document.querySelector('#myForm3')

// Google spreadsheet API endpoint

// ========================================

const scriptURL_formOne =
  'https://script.google.com/macros/s/AKfycbx_uNer4cGf-1CzIiV-hnQu9UUdDcNcFqlJlGfNOr2D65yD5zxYcuaL0hJGpNq6h2Q6Bg/exec'

const scriptURL_formTwo =
  'https://script.google.com/macros/s/AKfycbyhBnJQOYao23yyDbPOY3c1FYnQscIOt510ECudC59RQMfNdAxMy-5Vb3KKBerdn0iWEw/exec'

const scriptURL_formThree =
  'https://script.google.com/macros/s/AKfycbwJVEIOEio7jmxiCtdeebDW4Mlr3BO0J9b7ZhtjO4ZGSOWu9zhtL9T608EQtDywFbWB/exec'



//==========================================================================
const validate = (formQuery, URL) => {
  formQuery.addEventListener('submit', (e) => {
    e.preventDefault()
    // console.log("texting");
    fetch(URL, {
      method: 'POST',
      body: new FormData(formQuery),
    })
      .then((response) => {
        window.location.href = './successful.html'
        // alert('Thanks for Contacting us..! We Will Contact You Soon...')
      })
      .catch((error) => console.error('Error!', error.message))
  })
}

validate(formOne, scriptURL_formOne)
validate(formTwo, scriptURL_formTwo)
validate(formThree, scriptURL_formThree)
// ===========================================================================