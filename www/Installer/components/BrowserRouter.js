import DomRenderer from '../core/DomRenderer.js';
import { MiniReact } from '../core/React.js';

let routerBasePath;

export default function BrowserRouter(routes, rootElement, baseUrl = '') {
  routerBasePath = baseUrl;

  function renderCurrentRoute() {
    const pathname = location.pathname.replace(routerBasePath, '');
    const RouteComponent = routes[pathname];
    const Component = new RouteComponent({}, 'root');

    return Component.display(Component.props);
  }
  MiniReact.render(renderCurrentRoute(), rootElement);

  const oldPushState = history.pushState;
  history.pushState = function (data, unused, url) {
    oldPushState.call(history, data, unused, url);
    renderCurrentRoute();
  };

  window.addEventListener('popstate', function () {
    renderCurrentRoute();
  });
}
