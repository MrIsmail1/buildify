import { MiniReact } from '../core/React.js';

let routerBasePath;
let currentRouteInstance = null;

export default function BrowserRouter(routes, rootElement, baseUrl = '') {
  routerBasePath = baseUrl;

  function renderCurrentRoute() {
    const pathname = location.pathname.replace(routerBasePath, '');
    const RouteComponent = routes[pathname];
    if (RouteComponent) {
      currentRouteInstance = new RouteComponent();
      return currentRouteInstance.display();
    } else {
      window.location.href = '/bdfy-admin/installer/404Error';
    }
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
