import React from 'react';
import { shallow } from 'enzyme';
import { expect } from 'chai';
import Footer from '../../assets/js/components/footer.js';

describe('<Footer /> (components)',() => {

	it('renders with text', () => {
		let component = shallow(<Footer />);
		expect( component.html() ).to.contain('A project by');
	})

})
