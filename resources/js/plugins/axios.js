import axios from 'axios'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import {useAuthStore} from '../store/modules/auth'
import { useRouter } from 'vue-router'
import 'sweetalert2/dist/sweetalert2.min.css';

axios.defaults.baseURL = '/api';


// // Request interceptor
axios.interceptors.request.use(request => {

  
  const token = useAuthStore().token;
  
  if (token) {
    request.headers.Authorization = `Bearer ${token}`
  }
  // request.headers['X-Socket-Id'] = Echo.socketId()

  return request
})

// Response interceptor
axios.interceptors.response.use(response => response, error => {

  console.log('entro');
  
  const { status } = error.response
  // const router = useRouter();
  // const store = useAuthStore();
  
  // if (status === 401) {
  //   Swal.fire({
  //     icon: 'warning',
  //     title: i18n.t('token_expired_alert_title'),
  //     text: i18n.t('token_expired_alert_text'),
  //     reverseButtons: true,
  //     confirmButtonText: i18n.t('ok'),
  //     cancelButtonText: i18n.t('cancel')
  //   }).then(() => {
  //     store.logout();
  //     router.push({ name: 'login' })
  //   })
  // }

  console.log(status)
  if (status >= 500 || status == 405) {
    serverError(error.response)
  }

  return Promise.reject(error)
})

let serverErrorModalShown = false
async function serverError (response) {
  if (serverErrorModalShown) {
    return
  }

  if ((response.headers['content-type'] || '').includes('text/html')) {
    const iframe = document.createElement('iframe')

    if (response.data instanceof Blob) {
      iframe.srcdoc = await response.data.text()
    } else {
      iframe.srcdoc = response.data
    }

    Swal.fire({
      html: iframe.outerHTML,
      showConfirmButton: false,
      customClass: { container: 'server-error-modal' },
      didDestroy: () => { serverErrorModalShown = false },
      grow: 'fullscreen',
      padding: 0
    })

    serverErrorModalShown = true
  } else {
    Swal.fire({
      icon: 'error',
      title: 'An error has occurred.',
      text: 'Try again later.',
      reverseButtons: true,
      confirmButtonText: 'ok',
      cancelButtonText: 'cancel'
    })
  }
}


export default axios;