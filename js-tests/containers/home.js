import React from 'react';
import { mount, shallow } from 'enzyme';
import { expect } from 'chai';
import { Home, mapStateToProps } from '../../assets/js/containers/home.js';
import initialState from '../initial-state';

describe('<Home /> (containers)',() => {

	let props = mapStateToProps( initialState );

	it('renders with commands', () => {
		let component = shallow(<Home {...props} />);
		expect( component.find( 'li' ) ).to.have.length( 1 );
		expect( component.find( 'li' ).at( 0 ).find( 'Link' ).html() ).to.contain( 'db ack' );
	})

})
