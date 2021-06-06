import { Injectable } from '@angular/core';
import { MiaState } from '../entities/mia_state';
import { MiaBaseCrudHttpService } from '@agencycoda/mia-core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MiaStateService extends MiaBaseCrudHttpService<MiaState> {

  constructor(
    protected http: HttpClient
  ) {
    super(http);
    this.basePathUrl = environment.baseUrl + 'mia_state';
  }
 
}