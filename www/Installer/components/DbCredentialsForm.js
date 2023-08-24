import { MiniReact } from '../core/React.js';

export default class DbCredentialsForm extends MiniReact.Component {
  constructor(props) {
    super(props);
  }

  onSubmit = async (event) => {
    event.preventDefault();

    const form = event.target; // The form element
    const formData = new FormData(form);
    formData.append('step', 1);

    try {
      const response = await fetch('/installer/db', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        const data = await response.json();
        if (data.success) {
          Swal.fire('Success', 'Credentials are valid', 'success').then(
            (result) => {
              if (result.isConfirmed) {
                window.location.href = '/bdfy-admin/installer/step2';
              }
            }
          ); // Show success alert
        } else {
          Swal.fire('Error', 'Credentials are not valid', 'error'); // Show error alert
          // Handle invalid credentials here
        }
      } else {
        Swal.fire('Error', 'Request failed', 'error'); // Show error alert
        // Handle other error cases here
      }
    } catch (error) {
      Swal.fire('Error', 'An error occurred', 'error'); // Show error alert
      console.error('An error occurred', error);
      // Handle unexpected errors here
    }
  };

  render() {
    return MiniReact.createElement(
      'form',
      {
        onSubmit: this.onSubmit,
        className: 'space-y-6',
        method: 'POST',
      },
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'host',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Host'
      ),
      MiniReact.createElement('input', {
        id: 'host',
        name: 'host',
        type: 'text',
        required: true,
        className:
          'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
      }),
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'dbname',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Database name'
      ),
      MiniReact.createElement('input', {
        id: 'dbname',
        name: 'dbname',
        type: 'text',
        required: true,
        className:
          'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
      }),
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'username',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Username'
      ),
      MiniReact.createElement('input', {
        id: 'username',
        name: 'username',
        type: 'text',
        required: true,
        className:
          'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
      }),
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'password',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Password'
      ),
      MiniReact.createElement('input', {
        id: 'password',
        name: 'password',
        type: 'password',
        required: true,
        className:
          'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
      }),
      MiniReact.createElement(
        'button',
        {
          type: 'submit',
          className:
            'mt-6 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        },
        'Next Step'
      )
    );
  }
}
