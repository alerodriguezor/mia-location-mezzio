import { Injectable } from '@angular/core';
import { MiaCity } from '../entities/mia_city';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaCityService extends MiaBaseCrudHttpService<MiaCity> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_city';
  }
 
}