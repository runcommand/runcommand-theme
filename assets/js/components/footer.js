import React, { Component } from 'react';
import { Link } from 'react-router';

class Footer extends Component {

	render() {
		return (
			<footer className="site-footer">
				<div className="row">
					<div className="columns">
						<p>To learn more when there's more to know:</p>
						<ul>
							<li>Follow <a href="https://twitter.com/runcommand">@runcommand</a> on Twitter.</li>
							<li><a href="http://runcommand.us13.list-manage1.com/subscribe?u=65c9e1ec3c097ee95eb468c9f&id=5b6f61b116">Sign up</a> for the mailing list.</li>
						</ul>
						<p>A project by <a href="https://twitter.com/danielbachhuber">@danielbachhuber</a>.</p>
					</div>
				</div>
			</footer>
		);
	}

}

export default Footer;
