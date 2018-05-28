import PropTypes from "prop-types";
import React, {Component} from 'react';
import FormInput from './FormInput';
import Rating from './Rating';

class Form extends Component {

    getData(){
        let data={};

        for(let field in this.props.fields )
        {
            data[field] = this.refs[field].getValue()
        }
        return data;
    }

    getFormRowReadonly(field)
    {
        let data = this.props.fields[field],
            prefilled = this.prefilled;

        return <div className="FormRow" key={field}>
            <span className="FormLabel">{data.label}</span>
            {
                data.type === 'rating'
                    ? <Rating readonly={true} defaultValue={parseInt(prefilled,10)} />
                    :<div>{prefilled}</div>
            }
        </div>;
    }

    getFormRow(field)
    {
        let data = this.props.fields[field],
            prefilled = this.prefilled;

        return <div className="FormRow" key={field}>
            <label className="FormLabel" htmlFor={field}> {data.label}: </label>
            <FormInput {...data} ref={field} defaultValue={prefilled} />
        </div>;
    }

    renderForm(form = [])
    {
            for (let field in this.props.fields) {
                this.prefilled = this.props.initialData[field];

                if (!this.props.readonly) {
                    form.push(this.getFormRow(field));
                }else if (!this.prefilled) {
                    return null;
                } else
                {
                    form.push(this.getFormRowReadonly(field));
                }
            }

            return form;
    }

    render() {

        return (
            <form className="Form">{this.renderForm()}</form>
        );
    }
}

var FieldType = PropTypes.shape({
    //id: PropTypes.string.isRequired,
    label: PropTypes.string.isRequired,
    type: PropTypes.string,
    show: PropTypes.bool,
    sample: PropTypes.any
    //options: PropTypes.arrayOf(PropTypes.string)
});


Form.propTypes = {
    fields: PropTypes.objectOf( PropTypes.shape({
        name : PropTypes.instanceOf(FieldType),
        year : PropTypes.instanceOf(FieldType),
        rating : PropTypes.instanceOf(FieldType),
        comments : PropTypes.instanceOf(FieldType),
    })).isRequired,
    initialData: PropTypes.object,
    readonly: PropTypes.bool
};

export default Form