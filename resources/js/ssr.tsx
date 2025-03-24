import { createInertiaApp } from '@inertiajs/react';
import createServer from '@inertiajs/react/server';
import ReactDOMServer from 'react-dom/server';
import { route, RouteName } from 'ziggy-js';
import { resolveComponent } from './utils/inertia';

createServer((page) =>
  createInertiaApp({
    page,
    render: ReactDOMServer.renderToString,
    title: (title) => title,
    resolve: resolveComponent,
    setup: ({ App, props }) => {
      /* eslint-disable */
      // @ts-expect-error
      global.route<RouteName> = (name, params, absolute) =>
        route(name, params as any, absolute, {
          // @ts-expect-error
          ...page.props.ziggy,
          // @ts-expect-error
          location: new URL(page.props.ziggy.location),
        });
      /* eslint-enable */

      return <App {...props} />;
    },
  }),
);
