import { MiniReact } from '../core/React.js';

export default class InstallerHome extends MiniReact.Component {
  constructor(props) {
    super(props);
  }
  render() {
    return MiniReact.createElement(
      'div',
      {
        className: 'flex flex-col pr-5',
      },
      MiniReact.createElement(
        'h1',
        {
          className: 'lg:text-3xl text-gray-700 font-bold mb-3',
        },
        "Bienvenue dans l'installateur de buildify"
      ),
      MiniReact.createElement(
        'p',
        {
          className: 'whitespace-wrap lg:text-lg',
        },
        "Buildify CMS est une solution qui offre la possibilité de concevoir aisément un site web. Une fois que l'installation est achevée, un accès au tableau de bord administratif vous est accordé, vous permettant ainsi de modifier aisément la configuration de votre site internet."
      ),
      MiniReact.createElement(
        'div',
        {
          className: 'mt-3 flex justify-end',
        },
        MiniReact.createElement(
          'button',
          {
            onClick: this.props.nextStep,
            className:
              'border rounded-lg p-2 lg:text-lg font-bold bg-gray-700 text-white hover:text-gray-700 hover:bg-gray-200',
          },
          'Suivant'
        )
      )
    );
  }
}
