import { MiniReact } from '../core/React.js';

export default class UserCredentialsForm extends MiniReact.Component {
  constructor(props) {
    super(props);
  }

  onSubmit = async (event) => {
    event.preventDefault();

    const form = event.target; // The form element
    const formData = new FormData(form);
    formData.append('step', 2);

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
                window.location.href = '/bdfy-admin/login';
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
      },
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'firstname',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Prénom :'
      ),
      MiniReact.createElement('input', {
        id: 'firstname',
        name: 'firstname',
        type: 'text',
        required: true,
        className:
          'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
      }),
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'lastname',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Nom :'
      ),
      MiniReact.createElement('input', {
        id: 'lastname',
        name: 'lastname',
        type: 'text',
        required: true,
        className:
          'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
      }),
      MiniReact.createElement(
        'label',
        {
          htmlFor: 'email',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Adresse e-mail :'
      ),
      MiniReact.createElement('input', {
        id: 'email',
        name: 'email',
        type: 'email',
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
        'Mot de passe :'
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
        'label',
        {
          htmlFor: 'passwordConfirm',
          className: 'block text-sm font-medium leading-6 text-gray-900',
        },
        'Confirmation mot de passe :'
      ),
      MiniReact.createElement('input', {
        id: 'passwordConfirm',
        name: 'passwordConfirm',
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
