import {Http, Headers} from '@angular/http';
import {Injectable} from '@angular/core';
import {Observable} from "rxjs/Observable";
import 'rxjs/add/operator/map';
import { ICourseField } from '../store/coursefields/coursefields.types';
import { ISectorField } from '../store/sectorfields/sectorfields.types';
import { IRegion, IRegions, IRegionSchool } from '../store/regionschools/regionschools.types';
import { ISector, ISectors, ISectorCourse } from '../store/sectorcourses/sectorcourses.types';
import { AppSettings } from '../app.settings';

const HEADER = { headers: new Headers({ 'Content-Type': 'application/json' }) };

@Injectable()
export class HelperDataService {
    constructor(private http: Http) {
    };
    getCourseFields() {
        return new Promise((resolve, reject) => {
            this.http.get(`${AppSettings.API_ENDPOINT}/coursefields/list`)
            .map(response => <ICourseField[]>response.json())
            .subscribe(data => {
                resolve(data);
            }, // put the data returned from the server in our variable
            error => {
                console.log("Error HTTP GET Service"); // in case of failure show this message
                reject("Error HTTP GET Service");
            },
            () => console.log("Course Fields Received"));//run this code in all cases); */
        });
    };

    getSectorFields() {
        return new Promise((resolve, reject) => {
            this.http.get(`${AppSettings.API_ENDPOINT}/sectorfields/list`)
            .map(response => <ISectorField[]>response.json())
            .subscribe(data => {
                resolve(data);
            }, // put the data returned from the server in our variable
            error => {
                console.log("Error HTTP GET Service"); // in case of failure show this message
                reject("Error HTTP GET Service");
            },
            () => console.log("Sector Fields Received"));//run this code in all cases); */
        });
    };

    getRegionsWithSchools() {
        return new Promise((resolve, reject) => {
            this.http.get(`${AppSettings.API_ENDPOINT}/regions/list`)
            .map(response => response.json())
            .subscribe(data => {
//                console.log(data);
                resolve(this.transformRegionSchoolsSchema(data));
            }, // put the data returned from the server in our variable
            error => {
                console.log("Error HTTP GET Service"); // in case of failure show this message
                reject("Error HTTP GET Service");
            },
            () => console.log("region schools service"));//run this code in all cases); */
        });
    };

    getSectorsWithCourses() {
        return new Promise((resolve, reject) => {
            this.http.get(`${AppSettings.API_ENDPOINT}/coursesectorfields/list`)
            .map(response => response.json())
            .subscribe(data => {
//                console.log(data);
                resolve(this.transformSectorCoursesSchema(data));
            }, // put the data returned from the server in our variable
            error => {
                console.log("Error HTTP GET Service"); // in case of failure show this message
                reject("Error HTTP GET Service");
            },
            () => console.log("region schools service"));//run this code in all cases); */
        });
    };

    transformRegionSchoolsSchema(regionSchools: any) {
        let rsa = Array<IRegion>();
        let trackRegionId: string;
        let trackIndex: number;

        trackRegionId = "";
        trackIndex = -1;

        let j=0;
        regionSchools.forEach(regionSchool => {
            if (trackRegionId !== regionSchool.region_id) {
                trackIndex++;
                rsa.push(<IRegion>{'region_id': regionSchool.region_id, 'region_name': regionSchool.region_name, 'ieks': Array<IRegionSchool>()});
                trackRegionId = regionSchool.region_id;
            }
            rsa[trackIndex].ieks.push(<IRegionSchool>{'iek_id': regionSchool.iek_id, 'iek_name': regionSchool.iek_name, 'globalIndex': j, 'selected': false});
            j++;
        });
        return rsa;
    }

    transformSectorCoursesSchema(sectorCourses: any) {
        let rsa = Array<ISector>();
        let trackSectorId: string;
        let trackIndex: number;

        trackSectorId = "";
        trackIndex = -1;

        let j=0;
        sectorCourses.forEach(sectorCourse => {
            if (trackSectorId !== sectorCourse.sector_id) {
                trackIndex++;
                rsa.push(<ISector>{'sector_id': sectorCourse.sector_id, 'sector_name': sectorCourse.sector_name, 'sector_selected': sectorCourse.sector_selected, 'courses': Array<ISectorCourse>()});
                trackSectorId = sectorCourse.sector_id;
            }
            rsa[trackIndex].courses.push(<ISectorCourse>{'course_id': sectorCourse.course_id, 'course_name': sectorCourse.course_name, 'globalIndex': j, 'selected': false});
            j++;
        });
        return rsa;
    }

}
