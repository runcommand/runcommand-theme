import React, { Component } from 'react';
import { Link } from 'react-router';

class Footer extends Component {

	render() {
		return (
			<footer className="site-footer">
				<div className="row">
					<div className="columns">
						Follow <a href="https://twitter.com/runcommand">@runcommand</a> on Twitter. A project by <a href="https://twitter.com/danielbachhuber">@danielbachhuber</a>.
					</div>
				</div>
			</footer>
		);
	}

}

export default Footer;
