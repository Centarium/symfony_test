/*
* Главная концепция всего React - перерендер всего компонента при изменении состояния
* */
/*Start region Libraries*/
import React, {Component} from 'react';
import classNames from 'classnames';
import PropTypes from  'prop-types';
import ReactDOM from 'react-dom';
/*End region Libraries*/

/*Start region Components*/
import Rating from './Components/Form/Rating';
import Form from './Components/Form/Form';
import Actions from './Components/ExcelTable/Actions';
import Dialog from './Components/ExcelTable/Dialog';
import FormInput from './Components/Form/FormInput';
import CRUDStore from './Components/ExcelTable/flux/CRUDStore';
/*End region Components*/

class Excel extends Component
{
    constructor(props)
    {
        super(props);
        {debugger}

        this.storage = new CRUDStore();
        this.storage.init(schema);

        this.state = {
            data: this.storage.getData(),
            sortby: null,
            descending: false,
            edit: null,
            dialog: null
        };

        this.schema = this.storage.getSchema();
       
        this.storage.addListener('change', () => {
            this.setState({
            })
        });

    }

    componentWillReceiveProps(nextProps)
    {
        this.setState({data: nextProps.initialData});
    }


    _fireDataChange()
    {
        console.log('1');
    }

    _sort(key,e)
    {
        var column = key;
        let data = this.state.data.slice();
        const descending = this.state.sortby === key && !this.state.descending;

        data.sort(function (a,b) {
            return descending
                ? (a[column] < b[column] ? 1: -1 )
                : (a[column] > b[column] ? 1: -1 );
        });

        this.setState({
            data: data,
            sortby: key,
            descending: descending
        });

        this._fireDataChange();
    }

    _showEditor(e){

        if(this.state.edit !== null) return;

        this.setState({edit: {
                row: parseInt(e.target.dataset.row, 10),
                cell: parseInt(e.target.dataset.cell, 10),
                column: e.target.dataset.column
            }});
    }

    _save(e){
        e.preventDefault();
        const value = this.refs.input.getValue();
        let data  = this.state.data.slice();
        data[this.state.edit.row][this.state.edit.column] = value;
        this.setState({
            edit: null,
            data: data
        });
        this._fireDataChange();
    }

    /**
     * @param {number} rowidx
     * @param {object} e
     * @private
     */
    _actionClick(rowidx,e)
    {
        let action = e.target.dataset.operation;

        this.setState({dialog: {type:action,idx: rowidx}});
    }

    _closeDialog()
    {
        this.setState({dialog: null});
    }

    _deleteConfirmationClick(action)
    {
        if(action === 'dismiss')
        {
            this._closeDialog();
            return;
        }
        let data = Array.from(this.state.data);
        data.splice(this.state.dialog.idx, 1);
        this.setState({
            dialog: null,
            data: data
        });
        this._fireDataChange(data);
    }

    _saveDataDialog(action)
    {
        if(action === 'dismiss')
        {
            this._closeDialog();
            return;
        }
        let data = Array.from(this.state.data);
        data[this.state.dialog.idx] = this.refs.form.getData();
        this.setState({
            dialog:null,
            data:data
        });
        this._fireDataChange(data);
    }

    _renderDeleteDialog(){
        const first = this.state.data[this.state.dialog.idx];
        const nameguess = first.name;
        return (
            <Dialog
                modal={true}
                header="Confirm deletion"
                confirmLabel="Delete"
                onAction={this._deleteConfirmationClick.bind(this)}>
                {'Are you sure want to delete '+nameguess+'? '}
            </Dialog>
        );
    }

    _renderFormDialog(readonly){
        return(
            <Dialog
                modal={true}
                header={readonly ? 'Item info' : 'Edit item'}
                confirmLabel={readonly ? 'ok' : 'Save' }
                hasCancel={!readonly}
                onAction={this._saveDataDialog.bind(this)}>
                <Form ref="form" fields={this.schema}
                      initialData={this.state.data[this.state.dialog.idx]}
                      readonly={readonly}/>
            </Dialog>
        )
    }

    _renderDialog(){
        if(!this.state.dialog){
            return null;
        }
        switch (this.state.dialog.type)
        {
            case 'delete': return this._renderDeleteDialog();
            case 'info' : return this._renderFormDialog(true);
            case 'edit' : return this._renderFormDialog();
            default: throw Error('Unexpected dialog type ${this.state.dialog.type} ')
        }
    }

    _renderThead()
    {
        return (
            <thead>
                <tr>
                    {
                        Object.keys(this.storage.getHeaders()).map((key,idx) =>
                        {
                            let item = this.schema[key];

                            if(!item.show){
                                return null;
                            }

                            let title = item.label;
                            if( this.state.sortby === key ){
                                title += this.state.descending ? '\u2191' : ' \u2193';
                            }

                            return (
                                <th
                                    className={'schema-${key}'}
                                    key={key}
                                    onClick={this._sort.bind(this, key)}>
                                    {title}
                                </th>
                            )

                        }, this )

                    }
                    <th className="ExcelNotSortable">Actions</th>
                </tr>
            </thead>
        )
    }

    _renderTbody()
    {
        return (
            <tbody onDoubleClick={this._showEditor.bind(this)}>
            {
                this.state.data.map(this._createRows, this)
            }
            </tbody>
        )
    }

    _getColumnContent(rowidx, idx, columnId, content)
    {
        let columnOptions = this.schema[columnId];

        let edit = this.state.edit,
            isRating = this._isRating(columnOptions)

            if(!columnOptions || !columnOptions.show){
                return null;
            }


            if(!isRating && edit && edit.row === rowidx && edit.column === columnId && edit.cell === idx )
            {
                content = (
                    <form onSubmit={this._save.bind(this)}>
                        <FormInput ref="input" {...columnOptions} defaultValue={content}/>
                    </form>
                );
            } else if(isRating)
            {
                content = <Rating readonly={true} defaultValue={Number(content)} />
            }


            return (
                <td
                    className={classNames({
                        ['schema-${schema.id}']: true,
                        'ExcelEditable' : !isRating,
                        'ExcelDataLeft' : columnOptions.align === 'left',
                        'ExcelDataRight' : columnOptions.align === 'right',
                        'ExcelDataCenter' : columnOptions.align !== 'left' && columnOptions.align !== 'right'
                    })}
                    key={idx}
                    data-row={rowidx}
                    data-cell={idx}
                    data-column={columnId}
                >{content}</td>
            )
    }

    _getRowActions(rowidx)
    {
        return (
            <td className="ExcelDataCenter">
                <Actions onAction={this._actionClick.bind(this,rowidx)} />
            </td>
        )
    }

    _isRating(columnOptions)
    {
        return columnOptions.type === 'rating';
    }

    _getCellSchema(idx)
    {
        return this.schema[idx];
    }

    /**
     * Обработка массива данных таблицы
     * @param {object} dataItem
     * @param index
     * @returns {*}
     * @private
     */
    _createRows(dataItem, index)
    {
        return(
            <tr key={index}>

                {
                    Object.keys(dataItem).map((key, idx) =>
                    {
                        let content = dataItem[key];
                        return this._getColumnContent(index, idx, key, content)
                    }, this )
                }

                {this._getRowActions(index)}

            </tr>
        );
    }

    render(){

        return(
            <div className="Excel">

                <table>
                    {this._renderThead()}
                    {this._renderTbody()}
                </table>

                {this._renderDialog()}
            </div>
        );
    }
}

Excel.propTypes = {
    schema: PropTypes.objectOf(
        PropTypes.object
    ),
    initialData: PropTypes.arrayOf(
        PropTypes.object
    ),
    onDataChange: PropTypes.func
};

Excel.defaultProps = {

    schema: {},
    initialData: [{}],
    onDataChange: () => {},
}

var schema = {
    /*name:  {
        label: 'Name',
        show: true, // показать в таблице 'Excel'
        sample: '$2 chuck',
        align: 'left', // выравнивание в 'Excel'
    },

    year: {
        label: 'Year',
        type: 'year',
        show: true,
        sample: 2015,
    },

    rating :{
        label: 'Rating',
        type: 'rating',
        show: true,
        sample: 3
    },

    invoice_nr : {
        show : true,
        label: 'Invoice nr',
        type: 'input',
        sample: 'Invoice number',
    }*/
}


ReactDOM.render(
    <div>
        <h1>
             Welcome to Excel!
        </h1>
        <Excel />
    </div>,
    document.getElementById('pad')
);

export default Excel