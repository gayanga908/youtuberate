import {Pipe, PipeTransform} from "@angular/core";
/**
 * Created by Tharindu Gayanga on 2/14/2017.
 */
@Pipe({
    name: 'orderBy',
    pure: false

})
export class OrderBy implements PipeTransform{
    transform(value: Array<any>, args: any[]): any {
        let field: string = 'video_score';

        if(value==null) {
            return null;
        }
        if (field.startsWith("-")) {
            field = field.substring(1);
            if (typeof value[field] === 'string' || value[field] instanceof String) {

                return [...value].sort((a, b) => a[field].localeCompare(b[field]));
            }

            return [...value].sort((a, b) => a[field] - b[field]);
        }
        else {
            if (typeof value[field] === 'string' || value[field] instanceof String) {


                return [...value].sort((a, b) => -a[field].localeCompare(b[field]));
            }

            return [...value].sort((a, b) =>  b[field] - a[field]);

        }
    }
}