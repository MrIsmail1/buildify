import DbCredentialsForm from '../components/DbCredentialsForm.js';
import InstallerHome from '../components/InstallerHome.js';
import UserCredentialsForm from '../components/UserCredentialsForm.js';
import { MiniReact } from '../core/React.js';

export default class Start extends MiniReact.Component {
  constructor(props) {
    super(props);
    this.state = { currentStep: 1 };
  }
  nextStep = () => {
    this.setState({ currentStep: this.state.currentStep + 1 });
  };
  prevStep = () => {
    this.setState({ currentStep: this.state.currentStep - 1 });
  };

  render() {
    let Component;
    switch (this.state.currentStep) {
      case 1:
        Component = MiniReact.createElement(InstallerHome, {
          nextStep: this.nextStep,
        });
        break;
      case 2:
        Component = MiniReact.createElement(DbCredentialsForm, {
          nextStep: this.nextStep,
          prevStep: this.prevStep,
        });
        break;
      case 3:
        Component = MiniReact.createElement(UserCredentialsForm, {
          nextStep: this.nextStep,
          prevStep: this.prevStep,
        });
        break;
      default:
        Component = null;
    }
    return MiniReact.createElement(
      'div',
      {
        className: 'bg-gray-200',
      },
      MiniReact.createElement(
        'div',
        {
          className:
            'min-h-screen flex flex-col justify-center items-center lg:px-72 min-w-full',
        },
        MiniReact.createElement(
          'div',
          {
            className:
              'border rounded-lg bg-white flex p-8 gap-x-10 items-center',
          },
          MiniReact.createElement(
            'div',
            {
              className: 'w-9/12',
            },
            MiniReact.createElement('img', {
              src: '../../public/assets/buildify-logoPNG.png',
            })
          ),
          Component
        )
      )
    );
  }
}
