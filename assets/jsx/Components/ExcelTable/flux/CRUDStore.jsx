import {EventEmitter} from 'fbemitter';
import HtmlToJsonTransformer from '../../Helpers/HtmlToJsonTransformer';

const emitter = new EventEmitter();

class CRUDStore
{
    /*
    headers;
    data;
    schema;*/

    getData(): Array<Object> {
        return this.data;
    }

    getSchema(): Object {
        let headers = this.getHeaders();

        for (let header in headers)
        {
            if( this.schema.header === undefined )
            {
                this.schema[header] = this._getDefaultSchemaItem( header );
            }
        }

        return this.schema;
    }

    getHeaders(): Object {
        return this.headers;
    }

    setHeaders(){
        this.headers = this.Transformer.getTableHeaders();
    }


    getCount(): number {
        return this.data.length;
    }

    getRecord(recordId: number): ?Object {
        return recordId in this.data ? this.data[recordId] : null;
    }

    setData(newData: Array<Object>, commit: boolean = true) {
        this.data = newData;
        if (commit && 'localStorage' in window) {
            localStorage.setItem('data', JSON.stringify(newData));
        }

        emitter.emit('change');
    }


    init(initialSchema: Array<Object>) {
        this.schema = initialSchema;

        const storage = 'localStorage' in window
            ? localStorage.getItem('data')
            : null;

        const tableID = '#initialData table';

        this.Transformer = new HtmlToJsonTransformer;
        this.Transformer.setTable(tableID);


        this.setHeaders();

        if (!storage) {


            this.setData( this.Transformer.getTableBody() );

            //schema.forEach(item => this.data[0][item] = item.sample);
        } else {
            this.data = JSON.parse(storage);
        }
    }

    addListener(eventType: string, fn: Function) {
        emitter.addListener(eventType, fn);
    }

    _getDefaultSchemaItem(columnId)
    {
        return {
            show : true,
            label: columnId,
            type: 'input',
            sample: columnId,
        }
    }

}

export default CRUDStore