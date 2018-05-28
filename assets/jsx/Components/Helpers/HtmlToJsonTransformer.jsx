
class HtmlToJsonTransformer
{

    /**
     * @param tableID
     */
    setTable(tableID)
    {
        let table = $(tableID);
        if( !table || table === null) return false;

        this.Table = table;
    }


    /**
     * @return bool|Array
     */
    getTableBody()
    {
        if( this.Table === null ) return false;

        let tableBodyRows = this.Table.find('tbody tr'),
            data = [];

        tableBodyRows.each(function (rdx) {
            var rowCells = $(this).find('td');
            data[rdx] = {};

            rowCells.each(function(){

                let id = $(this).data('id'),
                    text = $(this).text();

                data[rdx][id] = text;
            });
        });

        return data;
    }

    /**
     * @param {string} tableID
     * @return bool|Object
     */
    getTableHeaders(tableID)
    {
        if( this.Table === null ) return false;

        let tableHead = this.Table.find('thead th'),
            data = {};

        tableHead.each(function(){
            let id = $(this).data('id'),
                text = $(this).text();

            data[id] = text;
        })

        return data;
    }
}

export default HtmlToJsonTransformer;