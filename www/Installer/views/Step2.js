import UserCredentialsForm from '../components/UserCredentialsForm.js';
import { MiniReact } from '../core/React.js';

export default class Step1 extends MiniReact.Component {
  constructor(props) {
    super(props);
  }
  render() {
    return MiniReact.createElement(
      'div',
      {
        className:
          'flex min-h-screen flex-col justify-center items-center px-6 lg:px-8',
      },
      MiniReact.createElement(
        'div',
        { className: 'sm:mx-auto sm:w-full sm:max-w-md' },
        MiniReact.createElement('img', {
          className: 'mx-auto h-12 w-auto',
          src: 'https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600',
          alt: 'Best Logo',
        }),
        MiniReact.createElement(
          'h2',
          {
            className:
              'mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900',
          },
          'Welcome to buildify'
        ),
        MiniReact.createElement(UserCredentialsForm)
      )
    );
  }
}
