import { MiniReact } from '../core/React.js';

export default class DbCredentialsForm extends MiniReact.Component {
  constructor(props) {
    super(props);
  }

  onSubmit = async (event) => {
    event.preventDefault();

    const form = event.target; // The form element
    const formData = new FormData(form);

    try {
      const response = await fetch('/installer/db', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        const data = await response.json();
        if (data.success) {
          Swal.fire(
            'Success',
            'Les identifiants de la base de données sont valides',
            'success'
          );
        } else {
          Swal.fire(
            'Error',
            'Les identifiants de la base de données sont invalides',
            'error'
          );
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
        className: 'flex flex-col pr-5',
      },
      MiniReact.createElement(
        'h1',
        {
          className: 'lg:text-3xl text-gray-700 font-bold mb-5',
        },
        'Saisissez les données de connexion à la base de données '
      ),
      MiniReact.createElement(
        'form',
        {
          onSubmit: this.onSubmit,
          className: 'flex flex-col gap-y-4 w-full',
          method: 'POST',
        },
        MiniReact.createElement(
          'label',
          {
            htmlFor: 'host',
            className: 'block text-sm font-medium leading-6 text-gray-900',
          },
          'Hôte :'
        ),
        MiniReact.createElement('input', {
          id: 'host',
          name: 'host',
          type: 'text',
          required: true,
          className:
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        }),
        MiniReact.createElement(
          'label',
          {
            htmlFor: 'dbname',
            className: 'block text-sm font-medium leading-6 text-gray-900',
          },
          'Nom de la base de données :'
        ),
        MiniReact.createElement('input', {
          id: 'dbname',
          name: 'dbname',
          type: 'text',
          required: true,
          className:
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        }),
        MiniReact.createElement(
          'label',
          {
            htmlFor: 'username',
            className: 'block text-sm font-medium leading-6 text-gray-900',
          },
          "Nom d'utilisateur :"
        ),
        MiniReact.createElement('input', {
          id: 'username',
          name: 'username',
          type: 'text',
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
          required: true,
          type: 'password',
          className:
            'block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
        }),
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
            'Tester la connexion'
          ),
          MiniReact.createElement(
            'button',
            {
              onClick: this.props.nextStep,
              className:
                'border rounded-lg py-2 px-5 lg:text-lg font-bold bg-gray-700 text-white hover:text-gray-700 hover:bg-gray-200',
            },
            'Suivant'
          )
        )
      )
    );
  }
}
