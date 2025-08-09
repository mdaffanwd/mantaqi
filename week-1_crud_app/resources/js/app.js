import './bootstrap';

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
window.toastr = toastr;

// custom defaults
toastr.options = {
  "positionClass": "toast-top-right",
  "timeOut": "3000",
};


const saveBtn = document.getElementById('modalSaveBtn');
const spinner = document.getElementById('modalSaveSpinner');

// Before fetch
saveBtn.setAttribute('disabled', true);
spinner.classList.remove('d-none');

// After fetch (both success/error)
saveBtn.removeAttribute('disabled');
spinner.classList.add('d-none');