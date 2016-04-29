import React from 'react';
import { Route, IndexRoute, Router, browserHistory } from 'react-router';
import { createStore, applyMiddleware } from 'redux';
import { Provider, connect } from 'react-redux';
import { render } from 'react-dom';
import thunk from 'redux-thunk'
import Home from './containers/home';
import NotFound from './components/not-found';
import reducer from './reducers';

const middleware = [ thunk ];

const store = createStore(
	reducer,
	window.runcommandInitialState,
	applyMiddleware(...middleware)
);

store.dispatch({
	type: 'APP_LOAD'
});

const routes = (
	<Route path="/" component={Home}>
		<Route path="*" component={NotFound} />
	</Route>
);

render(
	<Provider store={store}>
		<Router history={browserHistory} routes={routes} />
	</Provider>,
	document.getElementById('app')
);
