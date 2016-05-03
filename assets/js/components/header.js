import React, { Component } from 'react';
import { Link } from 'react-router';

class Header extends Component {

	render() {
		return (
			<header className="site-header">
				<div className="row">
					<div className="columns">
						<Link className="site-title" to="/">runcommand</Link> - <span className="site-description">The fastest way to do anything with WordPress</span>
					</div>
				</div>
			</header>
		);
	}

}

export default Header;
