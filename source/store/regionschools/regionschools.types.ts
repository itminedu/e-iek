import { List } from 'immutable';

export interface IRegion {
    region_id: string;
    region_name: string;
    ieks: IRegionSchool[];
}

export interface IRegionSchool {
    iek_id: string;
    iek_name: string;
    globalIndex: number;
    selected: boolean;
}

export type IRegions = List<IRegion>;
