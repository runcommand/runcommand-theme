import React, { Component } from 'react';
import { Route, IndexRoute, Router, browserHistory } from 'react-router';
import { createStore, applyMiddleware } from 'redux';
import { Provider, connect } from 'react-redux';
import { render } from 'react-dom';
import ga from 'react-ga';
import thunk from 'redux-thunk'
import Home from './containers/home';
import Command from './containers/command';
import Header from './components/header';
import Footer from './components/footer';
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

class App extends Component {

	render() {
		return (
			<div>
				<Header />
				<div className="site-content">
					<div className="row">
						<div className="columns">
							{this.props.children}
						</div>
					</div>
				</div>
				<Footer />
			</div>
		);
	}
}

const routes = (
	<Route path="/" component={App}>
		<IndexRoute component={Home} />
		<Route path="/command/:slug/" component={Command} />
		<Route path="*" component={NotFound} />
	</Route>
);

ga.initialize( window.runcommandGoogleAnalytics );

const onUpdate = () => {
	 ga.pageview( window.location.pathname );
};

render(
	<Provider store={store}>
		<Router history={browserHistory} routes={routes} onUpdate={onUpdate} />
	</Provider>,
	document.getElementById('app')
);
