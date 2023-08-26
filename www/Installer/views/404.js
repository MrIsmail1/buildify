import { MiniReact } from '../core/React.js';

export default class ErrorPage extends MiniReact.Component {
  constructor(props) {
    super(props);
  }
  render() {
    return MiniReact.createElement(
      'div',
      {
        className: 'min-h-screen flex items-center justify-center bg-gray-100',
      },
      MiniReact.createElement(
        'div',
        {
          className: 'max-w-md mx-auto px-4',
        },
        MiniReact.createElement(
          'div',
          {
            className: 'text-center',
          },
          MiniReact.createElement(
            'h1',
            {
              className: 'text-4xl font-semibold text-gray-800 mb-4',
            },
            'Erreur 404'
          ),
          MiniReact.createElement(
            'p',
            {
              className: 'text-xl text-gray-600 mb-4',
            },
            'Désolé, la page que vous recherchez est introuvable.'
          ),
          MiniReact.createElement(
            'p',
            {},
            MiniReact.createElement(
              'a',
              {
                href: '/bdfy-admin/installer/',
                className: 'text-indigo-600 hover:text-indigo-500',
              },
              "Retour à la page d'accueil"
            )
          )
        )
      )
    );
  }
}
