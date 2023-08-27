import { MiniReact } from '../core/React.js';

export default class UserCredentialsForm extends MiniReact.Component {
  constructor(props) {
    super(props);
  }

  onSubmit = async (event) => {
    event.preventDefault();

    const form = event.target; // The form element
    const formData = new FormData(form);

    try {
      const response = await fetch('/installer/launch', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        const data = await response.json();
        if (data.success) {
          Swal.fire(
            'Success',
            'Le compte admin a été créé avec succès',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '/bdfy-admin/login';
            }
          }); // Show success alert
        } else {
          Swal.fire('Error', `${data.errors ?? data.message}`, 'error'); // Show error alert
        }
      } else {
        Swal.fire('Error', 'Erreur', 'error'); // Show error alert
      }
    } catch (error) {
      Swal.fire('Error', 'Erreur', 'error'); // Show error alert
      console.error('An error occurred', error);
    }
  };

  render() {
    return MiniReact.createElement(
      'div',
      {
        className: 'flex flex-col pr-5 w-full',
      },
      MiniReact.createElement(
        'h1',
        {
          className:
            'lg:text-3xl text-gray-700 font-bold mb-5 whitespace-nowrap',
        },
        'Créer votre compte administrateur'
      ),
      MiniReact.createElement(
        'form',
        {
          onSubmit: this.onSubmit,
          className: 'flex flex-col gap-y-4 w-full',
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
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
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
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
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
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
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
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
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
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        }),
        MiniReact.createElement(
          'div',
          { className: 'inline-flex justify-start space-x-2' },
          MiniReact.createElement(
            'label',
            {
              htmlFor: 'fakeData',
              className: 'block text-sm font-medium leading-6 text-gray-900',
            },
            'Utiliser des fake data :'
          ),
          MiniReact.createElement('input', {
            id: 'fakeData',
            name: 'fakeData',
            type: 'checkbox',
            className: 'block px-1.5 py-1.5 text-gray-900',
          })
        ),
        MiniReact.createElement(
          'div',
          {
            className: 'py-5 flex justify-between',
          },
          MiniReact.createElement(
            'button',
            {
              onClick: this.props.prevStep,
              className:
                'border rounded-lg py-2 px-5 lg:text-lg font-bold bg-gray-700 text-white hover:text-gray-700 hover:bg-gray-200',
            },
            'Précédent'
          ),
          MiniReact.createElement(
            'button',
            {
              type: 'submit',
              className:
                'border rounded-lg py-2 px-5 lg:text-lg font-bold bg-gray-700 text-white hover:text-gray-700 hover:bg-gray-200',
            },
            'Lancer'
          )
        )
      )
    );
  }
}
