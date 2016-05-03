import React from 'react';
import { mount, shallow } from 'enzyme';
import { expect } from 'chai';
import { Command, mapStateToProps } from '../../assets/js/containers/command.js';
import initialState from '../initial-state';

describe('<Command /> (containers)',() => {

	let foundProps = mapStateToProps( initialState, { params: { slug: 'db-ack' } } );
	let notFoundProps = mapStateToProps( initialState, { params: { slug: 'foo-bar' } } );

	it('renders with a found command', () => {
		let component = shallow(<Command {...foundProps} />);
		expect( component.find( 'h2' ).text() ).to.equal( 'db ack' );
	});

	it('renders with a missing command', () => {
		let component = shallow(<Command {...notFoundProps} />);
		expect( component.html() ).to.contain( 'Command Not Found' );
	});

})
