import PropTypes from "prop-types";
import React, {Component} from 'react';
import './Rating';

class Form extends Component {

    getPrefilled(field)
    {
        return  this.props.initialData && this.props.initialData[field.id];
    }

    getData(){
        let data={};
        this.props.fields.forEach(
            field => data[field.id] = this.refs[field.id].getValue()
        );
        return data;
    }

    getFormRowReadonly(field)
    {
        let prefilled = this.getPrefilled(field);

        return <div className="FormRow" key={field.id}>
            <span className="FormLabel">{field.label}</span>
            {
                field.type === 'rating'
                    ? <Rating readonly={true} defaultValue={parseInt(prefilled,10)} />
                    :<div>{prefilled}</div>
            }
        </div>;
    }

    getFormRow(field)
    {
        let prefilled = this.getPrefilled(field);

        return <div className="FormRow" key={field.id}>
            <label className="FormLabel" htmlFor={field.id}> {field.label}: </label>
            <FormInput {...field} ref={field.id} defaultValue={prefilled} />
        </div>;
    }

    render() {

        return (
            <form className="Form">{this.props.fields.map(field=>{
                let prefilled = this.getPrefilled(field);
                if(!this.props.readonly)
                {
                    return (this.getFormRow(field));
                };
                if(!prefilled){
                    return null;
                }
                return (this.getFormRowReadonly(field));
            }, this)} </form>
        );
    }
}

Form.propTypes = {
    fields: PropTypes.arrayOf( PropTypes.shape({
        id: PropTypes.string.isRequired,
        label: PropTypes.string.isRequired,
        type: PropTypes.string,
        options: PropTypes.arrayOf(PropTypes.string)
    })).isRequired,
    initialData: PropTypes.object,
    readonly: PropTypes.bool
};

export default Form